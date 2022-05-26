import {useState} from 'react'

function useTemplateForm(initData) {

    const [data, setData] = useState(initData)

    const changeProperties = (properties) => {
        setData({...data, ...properties})
    }

    return {
        data,
        changeProperties
    }
}

export default useTemplateForm