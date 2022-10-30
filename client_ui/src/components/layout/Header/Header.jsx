import {AppBar, Stack, Toolbar, Typography} from "@mui/material";
import {styled} from "@mui/material/styles";
import NavigationMenu from "../../shared/Menus/NavigationMenu/NavigationMenu"
import TopMenuButton from "../TopMenu/TopMenuButton";
import TopMenu from "../TopMenu/TopMenu";
import {BurgerMenuProvider} from "../../../providers/BurgerMenu/BurgerMenuContext";
import ProfileMenu from "../../shared/Logos/Profile/ProfileMenu"

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
    const ResponsiveTopMenu = styled('div')(({theme}) => ({
        [theme.breakpoints.up('md')]: {
            display: "none"
        },
        [theme.breakpoints.up('sm')]: {
            paddingRight: "8px"
        }
    }))
    return (
        <AppBar
            position="sticky"
        >
            <BurgerMenuProvider>
                <Toolbar>
                    <Stack
                        direction="row"
                        justifyContent="space-between"
                        alignItems="center"
                        sx={{width: "100%"}}
                    >
                        <Typography variant="h5">
                            FCT
                        </Typography>
                        <ResponsiveNav>
                            <NavigationMenu/>
                        </ResponsiveNav>
                        <ProfileMenu />
                        <ResponsiveBtn>
                            <TopMenuButton/>
                        </ResponsiveBtn>
                    </Stack>
                </Toolbar>
                <ResponsiveTopMenu>
                    <TopMenu/>
                </ResponsiveTopMenu>
            </BurgerMenuProvider>
        </AppBar>
    )
}

export default Header