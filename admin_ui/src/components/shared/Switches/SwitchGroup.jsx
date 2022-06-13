import {FormControl, FormControlLabel, FormGroup, FormLabel, Switch} from "@mui/material"
import {useState} from "react"

function SwitchGroup({
                         label,
                         initItems = [/*{label: string, id: number, isChecked: bool}*/],
                         switchHandler
                     }) {

    const [items, setItems] = useState(initItems)

    const handleSwitch = e => {
        const newItems = items.map(item => {
            return item.id === Number(e.target.value) ? {...item, isChecked: e.target.checked} : item
        })
        switchHandler(newItems.filter(item => item.isChecked).map(item => item.id))
        setItems(newItems)
    }
    return (
        <FormControl component="fieldset">
            <FormLabel component="legend">{label}</FormLabel>
            <FormGroup aria-label={label} row>
                {items?.map((item) => {
                    return (<FormControlLabel
                        label={item.label}
                        labelPlacement="end"
                        value={item.id}
                        control={<Switch
                            color="primary"
                            checked={item.isChecked}
                            onChange={handleSwitch}
                        />}
                    />)
                })}
            </FormGroup>
        </FormControl>
    )
}

export default SwitchGroup