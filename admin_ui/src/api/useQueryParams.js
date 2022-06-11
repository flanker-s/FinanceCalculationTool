import {useState} from "react"

function useQueryParams(
    {
        pagination = 0,
        page = 1,
        search = {/*field1: value, field2: value*/},
        relations = {/*relation1: value, relation2: value*/},
        include = [/*'relation1', 'relation2'*/],
        sort = '' //field-asc or field-desc
    }) {

    const [query, setQuery] = useState(
        removeEmptyFields({
                paginate: pagination,
                page: page,
                filter: {...search, ...relations},
                include: [...include],
                sort: sort
            }
        ))

    const changePagination = (count) => {
        setQuery({...query, paginate: count, page: 1})
    }
    const changeSort = (orderBy, order) => {
        setQuery({...query, sort: `${orderBy}-${order}`, page: 1})
    }
    const changeFilters = (filters) => {
        const newQuery = {...query}
        Object.keys(filters)?.forEach((filterName)=>{
            newQuery.filter[filterName] = filters[filterName]
        })
        newQuery['page'] = 1
        setQuery(newQuery)
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

    return ({
        query,
        changePagination,
        changeSort,
        changeFilters,
        removeFilters,
        changeIncludes,
        changePage,
        resetQuery,
    })
}

export default useQueryParams

function removeEmptyFields(obj) {
    return Object.fromEntries(Object.entries(obj).filter(([key]) => {
        if(typeof obj[key] === 'object'){
            removeEmptyFields(obj[key])
        }
        return !!(obj[key])
    }))
}