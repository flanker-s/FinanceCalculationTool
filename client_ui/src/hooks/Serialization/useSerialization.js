
function useSerialization() {
    const serializeGetParams = (params) => {
        if(Object.keys(params).length === 0){
            return
        }
        return Object.keys(params).reduce((query, key) => {
            const param = params[key]
            if(Array.isArray(param)){
                return query + param.reduce((q, s) =>{
                    return q + key + '[]=' +  s + '&'
                }, '')
            }
            if(typeof param === 'object'){
                return query +  Object.keys(param).reduce((q, k) => {
                    return q + key + '[' + k + ']=' + param[k] + '&'
                }, '')
            }
            return query + key + '=' + param.toString() + '&'
        }, '').replace(/&$/, '')
    }

    return {
        serializeGetParams
    }
}

export default useSerialization