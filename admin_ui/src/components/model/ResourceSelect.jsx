import React, {useState} from 'react'
import {FormControl, InputLabel, Select} from "@mui/material"
import MenuItem from "@mui/material/MenuItem"
import useApiResource from "../../api/useApiResource"
import LoadingSwitch from "../shared/Loading/LoadingSwitch"
import Loading from "../shared/Loading/Loading"
import {capitalizeFirstLetter} from "../../utils/Formatters/StringFormatter"

function ResourceSelect({
                            url,
                            initQuery,
                            label="resource",
                            allowAll = false,
                            initSelected = null,
                            selectHandler
                        }) {
    const labelId = label + "-select-label"

    const {items, status} = useApiResource(url, initQuery)

    const [selected, setSelected] = useState(initSelected)

    const handleSelect = e => {
        const value = e.target.value
        setSelected(value)
        selectHandler(value)
    }

    return (
        <LoadingSwitch
            status={status}
            loading={<Loading/>}
            completed={
                <FormControl>
                    <InputLabel id={labelId}>{capitalizeFirstLetter(label)}</InputLabel>
                    <Select
                        labelId={labelId}
                        label={capitalizeFirstLetter(label)}
                        id={labelId}
                        value={selected}
                        onChange={handleSelect}
                    >
                        {allowAll ? <MenuItem value="all">Select all</MenuItem> : ''}
                        {items?.map((item, i) => {
                            return <MenuItem key={i} value={item.id}>{item.attributes.name}</MenuItem>
                        })}
                    </Select>
                </FormControl>
            }
        />
    )
}

export default ResourceSelect