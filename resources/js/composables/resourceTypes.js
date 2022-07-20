import {ref} from "vue";

export default function useResourceItemTypes() {
    const resourceItemsTypes = ref([])

    const getResourceItemTypes = async () => {
        axios.get('api/resource-types')
            .then(response => {
                resourceItemsTypes.value = response.data
            })
    }


    return { resourceItemsTypes, getResourceItemTypes }
}
