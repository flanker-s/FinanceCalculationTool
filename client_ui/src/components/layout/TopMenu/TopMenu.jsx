import {Stack} from "@mui/material"
import NavigationMenu from "../../shared/Menus/NavigationMenu/NavigationMenu"
import BurgerMenuContext from "../../../providers/BurgerMenu/BurgerMenuContext";
import {useContext} from "react";

function TopMenu() {
    const {isActive} = useContext(BurgerMenuContext)
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

export default TopMenu
