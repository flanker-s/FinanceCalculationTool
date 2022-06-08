import useToken from "../hooks/Authorization/useToken"
import useSerialization from "../hooks/Serialization/useSerialization"
import {useEffect, useState} from "react"
import {api} from "./ApiConnection"

function useApiResource(url, initQuery = {}) {

    const version = '/v1'

    const {getToken} = useToken()
    const {serializeGetParams} = useSerialization()

    const [query, setQuery] = useState(initQuery)

    const [status, setStatus] = useState('processing')
    const [error, setError] = useState()

    const [meta, setMeta] = useState()
    const [links, setLinks] = useState()
    const [items, setItems] = useState()

    useEffect(()=>{
        index()
    }, [query])

    const changePagination = (count) => {
        setQuery({...query, paginate: count, page: 1})
    }
    const changeSort = (orderBy, order) => {
        setQuery({...query, sort: `${orderBy}-${order}`, page: 1})
    }
    const changeFilters = (filter) => {
        setQuery({...query, filter: filter, page: 1})
    }
    const removeFilters = (...filters) => {
        const newQuery = {...query}
        filters?.forEach((filter)=>{
            delete newQuery.filter[filter]
        })
        console.log(newQuery)
        newQuery['page'] = 1
        setQuery(newQuery)
    }
    const changeIncludes = (includes) => {
        setQuery({...query, include: includes, page: 1})
    }
    const changePage = (number) => {
        setQuery({...query, page: number})
    }
    const resetQuery = () => {
        setQuery({})
    }

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
        getItemById,
        changePagination,
        changeSort,
        changeFilters,
        removeFilters,
        changeIncludes,
        changePage,
        resetQuery,
        create,
        update,
        remove
    }
}

export default useApiResource