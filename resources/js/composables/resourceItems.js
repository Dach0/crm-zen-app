import {ref} from "vue";

export default function useResourceItems() {
    const resourceItems = ref([])

    const getResourceItems = async (resourceTypeFilter = '') => {
        axios.get('api/resource-items?resourceTypeFilter=' + resourceTypeFilter)
            .then(response => {
                resourceItems.value = response.data.data
            })
    }

    const deleteResourceItem = async (id) => {
        if (confirm("Are you sure you want to delete a record?")) {
            axios.delete('/api/resource-items/' + id)
                .then(response => {
                    getResourceItems()
                })
                .catch(error => {
                    alert('Something went wrong')
                })
        }
    }


    return {
        resourceItems,
        getResourceItems,
        deleteResourceItem
    }
}
