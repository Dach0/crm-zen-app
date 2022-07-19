import {ref} from "vue";

export default function useResourceItems() {
    const resourceItems = ref([])

    const getResourceItems = async () => {
        axios.get('api/resource-items')
            .then(response => {
                resourceItems.value = response.data
            })
    }


    return { resourceItems, getResourceItems }
}
