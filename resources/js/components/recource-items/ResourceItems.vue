<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="flex flex-row-reverse">
                    <button
                        type="button"
                        class="inline-flex items-center px-2.5 py-1.5 my-2 border border-transparent text-xs font-medium rounded text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        @click="openCreateModal"
                    >
                        Create resource
                    </button>
                    <create-edit-modal
                        :open="showDialog"
                        :editing-item="editingItem"
                        :resource-item-types="resourceItemsTypes"
                        @closeDialog="closeDialogAndClearEditItem()"
                    />
                </div>
                <simple-filter
                    :items="resourceItemsTypes"
                    @filterChanged="this.selectedType = $event"
                />
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Title
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created at
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Updated at
                            </th>
                            <th scope="col"
                                colspan="2"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider"
                            >
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="item in resourceItems" :key="item.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ item.title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-center">
                                <i :class="getIconClassBasedOnType(item.type)"/>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.created_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.updated_at }}
                            </td>
                            <td class="pl-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900" @click.prevent="openEditModal(item)">Edit</a>
                            </td>
                            <td class="pr-6 pl-2 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-red-600 hover:text-red-900" @click.prevent="deleteResourceItem(item.id)">Del</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import useResourceItems from "../../composables/resourceItems";
import {onMounted, ref, watch} from "vue";
import useResourceItemTypes from "../../composables/resourceTypes";
import getIconClassBasedOnType from "../../helpers";
import SimpleFilter from '../recource-items/SimpleFilter.vue'
import CreateEditModal from "./CreateEditModal.vue";

const selectedType = ref('')
const {resourceItems, getResourceItems, deleteResourceItem} = useResourceItems()
const {resourceItemsTypes, getResourceItemTypes} = useResourceItemTypes()

let showDialog = ref(false)
let editingItem = ref(null)

function openCreateModal() {
    showDialog.value = true
    editingItem.value = null
}

function openEditModal(item) {
    editingItem.value = {...item}
    showDialog.value = true
}

function closeDialogAndClearEditItem() {
    showDialog.value = false
    editingItem.value = null
}

onMounted(() => {
    getResourceItems()
    getResourceItemTypes()
})

watch(selectedType, (curr, prev) => {
    getResourceItems(curr)
})

</script>
