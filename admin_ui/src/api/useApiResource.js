import useToken from "../hooks/Authorization/useToken"
import useSerialization from "../hooks/Serialization/useSerialization"
import {useEffect, useState} from "react"
import {api} from "./ApiConnection"
import useQueryParams from "./useQueryParams"

function useApiResource(url, initParams = {}) {

    const version = '/v1'

    const {getToken} = useToken()
    const {serializeGetParams} = useSerialization()

    const {
        query,
        changePagination,
        changeSort,
        changeFilters,
        removeFilters,
        changeIncludes,
        changePage,
        resetQuery,
    } = useQueryParams(initParams)

    const [status, setStatus] = useState('processing')
    const [error, setError] = useState()

    const [meta, setMeta] = useState()
    const [links, setLinks] = useState()
    const [items, setItems] = useState()

    useEffect(()=>{
        index()
    }, [query])

    const getItemById = (id) => {
        return items.find(item => item.id === id)
    }

    const index = () => {
        setStatus('processing')
        api.interceptors.request.use(request => {
            console.log('Starting Request', JSON.stringify(request, null, 2))
            return request
        })
        console.log(serializeGetParams(query))
        api.get(version + url, {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${getToken()}`
            },
            params: query,
            paramsSerializer: params => serializeGetParams(params)
        }).then(({data}) => {
            setMeta(data?.meta)
            setLinks(data?.links)
            setItems(data?.data)
            if(data){
                setStatus('completed')
            }
        }).catch(error => {
            setError(error)
            setStatus('error')
        })
    }

    const create = (data) => {
        api.post(version + url, data, {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${getToken()}`
            }
        }).then(() => {
            index()
        }).catch(error => {
            setError(error)
            setStatus('error')
        })
    }

    const update = (id, data) => {
        api.put(version + url + '/' + id, data, {
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${getToken()}`
            }
        }).then(() => {
            index()
        }).catch(error => {
            setError(error)
            setStatus('error')
        })
    }

    const remove = (id) => {
        api.delete(version + url + '/' + id,{
            headers: {
                Accept: 'application/json',
                Authorization: `Bearer ${getToken()}`
            }
        }).then(() => {
            index()
        }).catch(error => {
            setError(error)
            setStatus('error')
        })
    }

    return {
        status,
        error,
        meta,
        query,
        links,
        items,
        changePagination,
        changeSort,
        changeFilters,
        removeFilters,
        changeIncludes,
        changePage,
        resetQuery,
        getItemById,
        create,
        update,
        remove
    }
}

export default useApiResource