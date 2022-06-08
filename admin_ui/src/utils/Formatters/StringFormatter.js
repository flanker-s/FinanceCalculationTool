
export function capitalizeFirstLetter(str) {
    if(str && str[0]){
        return str.slice(1) ? str[0].toUpperCase() + str.slice(1) : ''
    }
    return ''
}