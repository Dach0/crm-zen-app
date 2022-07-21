import {ref} from "vue";

export default function useResourceItems() {
    const resourceItems = ref([])
    const validationErrors = ref({})
    const isLoading = ref(false)

    const getResourceItems = async (resourceTypeFilter = '') => {
        axios.get('api/resource-items?resourceTypeFilter=' + resourceTypeFilter)
            .then(response => {
                resourceItems.value = response.data.data
            })
    }

    const storeResourceItem = async (resourceItem) => {
        if (isLoading.value) return;

        isLoading.value = true
        validationErrors.value = {}

        let serializedResourceItem = new FormData()

        for (let field in resourceItem) {
            if (resourceItem.hasOwnProperty(field)) {
                serializedResourceItem.append(field, resourceItem[field])
            }
        }

        axios.post('api/resource-items', serializedResourceItem)
            .then(response => {})
            .catch(error => {
                if (error.response?.data) {
                    validationErrors.value = error.response.data.errors
                }
            })
            .finally(() => isLoading.value = false)
    }


    return { resourceItems, getResourceItems, storeResourceItem, validationErrors, isLoading }
}
