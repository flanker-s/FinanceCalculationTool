import React, {useContext} from 'react'
import SwitchGroup from "../../shared/Switches/SwitchGroup"
import AuthContext from "../../../providers/Authentication/AuthContext"
import {capitalizeFirstLetter} from "../../../utils/Formatters/StringFormatter"
import Box from "@mui/material/Box"

function AbilitySwitchGroup({selectedIds, switchHandler}) {

    //User can allow only the abilities he owns
    const {user} = useContext(AuthContext)
    const items = user.included.abilities.map(ability=>{
        return {
            label: formatAbilityName(ability.attributes.name),
            id: ability.id,
            isChecked: selectedIds.includes(ability.id)
        }
    })

    return (
        <Box sx={{
            paddingTop: "14pt"
        }}>
            <SwitchGroup
                label="Abilities"
                initItems={items}
                switchHandler={switchHandler}
            />
        </Box>
    )
}

function formatAbilityName(name){
    const words = name?.split('-')
    if(words && words.length === 2){
           return capitalizeFirstLetter(words[0]) + ' ' + words[1]
    }
}

export default AbilitySwitchGroup