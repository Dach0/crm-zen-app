<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                    <DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
                </TransitionChild>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full sm:p-6">
                        <div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <div class="mt-2">
                                    <form @submit.prevent="storeResourceItem(resourceItem)" class="space-y-8 divide-y divide-gray-200">
                                        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                                            <div>
                                                <div>
                                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Create/edit resource</h3>
                                                </div>

                                                <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">

                                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="resource-type" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Resource type </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <select
                                                                id="resource-type"
                                                                v-model="resourceItem.resource_item_type_id"
                                                                name="resource-type"
                                                                autocomplete="resource-type"
                                                                class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                                            >
                                                                <option value="">Choose type</option>
                                                                <option v-for="item in resourceItemTypes" :value="item.id">{{ item.type }}</option>
                                                            </select>
                                                            <div
                                                                class="text-sm text-red-500 mt-1"
                                                                v-for="message in validationErrors?.resource_item_type_id"
                                                            >
                                                                {{ message }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="title" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Title </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <input v-model="resourceItem.title" type="text" name="title" id="title" autocomplete="given-name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" />
                                                            <div
                                                                class="text-sm text-red-500 mt-1"
                                                                v-for="message in validationErrors?.title"
                                                            >
                                                                {{ message }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- PDF form part -->
                                                    <div v-if="shouldShowForm('PDF')" class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                        <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> File upload </label>
                                                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                            <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                                                <div class="space-y-1 text-center">
                                                                    <p v-if="resourceItem.pdf_file">{{ resourceItem.pdf_file.name }}</p>
                                                                    <svg v-else class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                                    </svg>
                                                                    <div class="flex text-sm text-gray-600">
                                                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                                            <span>Upload a file</span>
                                                                            <input
                                                                                id="file-upload"
                                                                                name="file-upload"
                                                                                type="file"
                                                                                class="sr-only"
                                                                                @change="resourceItem.pdf_file = $event.target.files[0]"
                                                                            />
                                                                        </label>
                                                                        <p class="pl-1">or drag and drop</p>
                                                                    </div>
                                                                    <p class="text-xs text-gray-500">PDF up to 2MB</p>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="text-sm text-red-500 mt-1"
                                                                v-for="message in validationErrors?.pdf_file"
                                                            >
                                                                {{ message }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./ PDF form part-->

                                                    <!-- ./ HTML form part-->
                                                    <template v-if="shouldShowForm('HTML')" >
                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="snippet-description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Description </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <textarea v-model="resourceItem.description" id="snippet-description" name="snippet-description" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" />
                                                                <p class="mt-2 text-sm text-gray-500">Describe your snippet here.</p>
                                                                <div
                                                                    class="text-sm text-red-500 mt-1"
                                                                    v-for="message in validationErrors?.description"
                                                                >
                                                                    {{ message }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="snippet-code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Snippet </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <textarea v-model="resourceItem.html_snippet" id="snippet-code" name="snippet-code" rows="7" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" />
                                                                <p class="mt-2 text-sm text-gray-500">Paste or write your snippet here</p>
                                                                <div
                                                                    class="text-sm text-red-500 mt-1"
                                                                    v-for="message in validationErrors?.html_snippet"
                                                                >
                                                                    {{ message }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <!-- ./ HTML form part-->

                                                    <!-- LINK form part-->
                                                    <template v-if="shouldShowForm('LINK')" >
                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                                            <label for="website" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Website </label>
                                                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">include http:// </span>
                                                                    <input v-model="resourceItem.link" type="text" name="website" id="website" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="http://www.example.com" />
                                                                </div>
                                                                <div
                                                                    class="text-sm text-red-500 mt-1"
                                                                    v-for="message in validationErrors?.link"
                                                                >
                                                                    {{ message }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                                            <div />
                                                            <div class="col-span-2">
                                                                <div class="max-w-lg space-y-4">
                                                                    <div class="relative flex items-start">
                                                                        <div class="flex items-center h-5">
                                                                            <input v-model="resourceItem.open_in_new_tab" id="new-tab-chkx" name="new-tab-chkx" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded" />
                                                                        </div>
                                                                        <div class="ml-3 text-sm">
                                                                            <label for="new-tab-chkx" class="font-medium text-gray-700">New tab</label>
                                                                            <p class="text-gray-500">Check here if site should be opened in new tab when clicked</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <!-- ./ LINK form part-->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-5">
                                            <div class="flex justify-end">
                                                <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" @click="$emit('closeDialog')">Cancel</button>
                                                <button type="submit" :disabled="isLoading" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    <svg v-show="isLoading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                    </svg>
                                                    {{ isLoading ? 'Processing' : 'Save'}}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </TransitionChild>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import {reactive, ref} from 'vue'
import { Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot } from '@headlessui/vue'
import useResourceItems from "../../composables/resourceItems";

const { storeResourceItem, validationErrors, isLoading } = useResourceItems()
const resourceType = ref('')

const resourceItem = reactive({
    title: '',
    resource_item_type_id: '',
    pdf_file: '',
    description: '',
    html_snippet: '',
    link: '',
    open_in_new_tab: false
})

const props = defineProps({
    open: Boolean,
    resourceItemTypes: Array
})

function shouldShowForm(typeOfForm) {
    const selected = props.resourceItemTypes.find(item => item.id === resourceItem.resource_item_type_id)
    if(selected){
        return selected.type === typeOfForm
    }
}

</script>
