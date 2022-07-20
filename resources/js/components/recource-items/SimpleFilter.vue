<template>
    <Menu as="div" class="relative text-left mb-2">
        <div>
            <MenuButton
                class="justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none">
                Options
                <i class="fa-solid fa-chevron-down"></i>
            </MenuButton>
        </div>

        <transition enter-active-class="transition ease-out duration-100"
                    enter-from-class="transform opacity-0 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-75"
                    leave-from-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 scale-95">
            <MenuItems
                class="origin-top-right absolute right-0 mt-3 w-full rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                <div class="py-1">
                    <MenuItem
                        v-slot="{ active }"
                        @click="$emit('filter-changed', '')"
                    >
                        <a href="#"
                           :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
                            <i class="mr-2 fa-solid fa-filter-circle-xmark"/>
                            Show all
                        </a>
                    </MenuItem>
                    <MenuItem
                        v-for="resourceType in items"
                        :key="resourceType.id"
                        v-slot="{ active }"
                        @click="$emit('filter-changed', resourceType.id)"
                    >
                        <a href="#"
                           :class="[active ? 'bg-gray-100 text-gray-900' : 'text-gray-700', 'group flex items-center px-4 py-2 text-sm']">
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
</template>

<script setup>
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import getIconClassBasedOnType from "../../helpers";

const props = defineProps({
    items: Array
})

</script>
