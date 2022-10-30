import {Button} from "@mui/material"
import {NavLink} from "react-router-dom"
import {useTheme} from "@mui/material"


function NavigationMenuItem({routeName, url}) {
    const theme = useTheme()
    return (
        <Button
            component={NavLink}
            to={url}
            color="negative"
            style={({ isActive }) => ({
                color: isActive ? theme.palette.active.main : theme.palette.negative.main,
            })}
        >
            {routeName}
        </Button>
    )
}

export default NavigationMenuItem;
