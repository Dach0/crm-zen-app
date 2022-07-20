export default function getIconClassBasedOnType(resourceType) {
    switch (resourceType) {
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
