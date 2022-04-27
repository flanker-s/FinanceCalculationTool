import classes from './Header.module.css'

import {AppBar, Stack, IconButton, Toolbar, Typography} from "@mui/material";
import MenuIcon from "@mui/icons-material/Menu"
import NavigationMenu from "../NavigationMenu/NavigationMenu"
import {styled} from "@mui/material/styles";
import ProfileLogo from "../Profile/ProfileLogo";

function Header() {
    const ResponsiveNav = styled('div')(({theme}) => ({
        [theme.breakpoints.down('md')]: {
            display: "none"
        }
    }))
    const ResponsiveBtn = styled('div')(({theme}) => ({
        [theme.breakpoints.up('md')]: {
            display: "none"
        }
    }))
    return (
        <AppBar
            position="sticky"
        >
            <Toolbar>
                <Stack
                    direction="row"
                    justifyContent="space-between"
                    alignItems="center"
                    spacing={2}
                    sx={{width: "100%"}}
                >
                    <Typography variant="h5">
                        FCT
                    </Typography>
                    <ResponsiveNav>
                        <NavigationMenu/>
                    </ResponsiveNav>
                    <ProfileLogo />
                    <ResponsiveBtn>
                        <IconButton size="medium">
                            <MenuIcon fontSize="large" color="negative"/>
                        </IconButton>
                    </ResponsiveBtn>
                </Stack>
            </Toolbar>
        </AppBar>
    )
}

export default Header