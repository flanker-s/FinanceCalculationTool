import {IconButton} from "@mui/material"
import MenuIcon from "@mui/icons-material/Menu"
import MenuOpenIcon from '@mui/icons-material/MenuOpen'
import {useContext} from "react"
import BurgerMenuContext from "../../contexts/BurgerMenuContext"

function BurgerMenuButton() {
    const {isActive, setActivity} = useContext(BurgerMenuContext)
    return (
        <IconButton size="medium" onClick={()=>setActivity(!isActive)}>
            {
                isActive
                    ? <MenuOpenIcon fontSize="large" color="negative"/>
                    : <MenuIcon fontSize="large" color="negative"/>
            }

        </IconButton>
    )
}

export default BurgerMenuButton;
