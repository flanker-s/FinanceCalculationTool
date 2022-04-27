import {Stack} from "@mui/material"
import NavigationMenu from "../NavigationMenu/NavigationMenu"
import BurgerMenuContext from "../../contexts/BurgerMenuContext";
import {useContext} from "react";

function BurgerMenu() {
    const {isActive} = useContext(BurgerMenuContext)
    console.log(isActive)
    return (
        <Stack sx={{
            display: isActive ? "flex" : "none",
            paddingTop: "16px",
            paddingBottom: "16px",
        }}>
            <NavigationMenu direction="column"/>
        </Stack>
    )
}

export default BurgerMenu
