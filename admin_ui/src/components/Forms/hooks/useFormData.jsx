import {useState} from 'react'

function useFormData(initData) {

    const [data, setData] = useState(initData)

    const changeProperties = (properties) => {
        setData({...data, ...properties})
    }

    return {
        data,
        changeProperties
    }
}

export default useFormData