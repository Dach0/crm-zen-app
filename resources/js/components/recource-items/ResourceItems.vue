<template>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <Menu as="div" class="relative text-left mb-2">
                        <div>
                            <MenuButton class="justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                                Options
                                <i class="fa-solid fa-chevron-down"></i>
                            </MenuButton>
                        </div>

                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="origin-top-right absolute right-0 mt-3 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                <div class="py-1">
                                    <MenuItem
                                        v-for="resourceType in resourceItemsTypes"
                                        :key="resourceType.id"
                                        v-slot="{ active }"
                                        @click="selectedType = resourceType.id"
                                    >
                                        <a href="#" :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
                                            <i
                                                class="mr-3"
                                                :class="getIconClassBasedOnType(resourceType.type)"
                                            />
                                            {{ resourceType.type }}
                                        </a>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created at</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated at</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="item in resourceItems" :key="item.id">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ item.title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-500 text-center">
                                <i :class="getIconClassBasedOnType(item.type)" />
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.created_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.updated_at }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
import {onMounted, ref} from "vue";
import useResourceItemTypes from "../../composables/resourceTypes";
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'

    const selectedType = ref('')
    const { resourceItems, getResourceItems } = useResourceItems()
    const { resourceItemsTypes, getResourceItemTypes } = useResourceItemTypes()

    onMounted( () => {
        getResourceItems()
        getResourceItemTypes()
    })

    function getIconClassBasedOnType(resourceType) {
        switch(resourceType) {
            case 'PDF':
                return 'fa-solid fa-file-pdf'
            case 'HTML':
                return 'fa-brands fa-html5'
            case 'LINK':
                return 'fa-solid fa-link'
            default:
                return ''
        }
    }

</script>
