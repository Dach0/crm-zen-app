import {ref} from "vue";

export default function useResourceItems() {
    const resourceItems = ref([])

    const getResourceItems = async (resourceTypeFilter = '') => {
        axios.get('api/resource-items?resourceTypeFilter=' + resourceTypeFilter)
            .then(response => {
                resourceItems.value = response.data.data
            })
    }


    return { resourceItems, getResourceItems }
}
