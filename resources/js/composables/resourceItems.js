import {ref} from "vue";

export default function useResourceItems() {
    const resourceItems = ref([])
    const validationErrors = ref({})

    const getResourceItems = async (resourceTypeFilter = '') => {
        axios.get('api/resource-items?resourceTypeFilter=' + resourceTypeFilter)
            .then(response => {
                resourceItems.value = response.data.data
            })
    }

    const storeResourceItem = async (resourceItem) => {
        console.log(resourceItem)
        axios.post('api/resource-items', resourceItem)
            .then(response => {})
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
    }


    return { resourceItems, getResourceItems, storeResourceItem, validationErrors }
}
