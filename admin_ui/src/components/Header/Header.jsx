import {AppBar, Stack, Toolbar, Typography} from "@mui/material";
import {styled} from "@mui/material/styles";
import NavigationMenu from "../NavigationMenu/NavigationMenu"
import BurgerMenuButton from "../BurgerMenu/BurgerMenuButton";
import BurgerMenu from "../BurgerMenu/BurgerMenu";
import {BurgerMenuProvider} from "../../contexts/BurgerMenuContext";
import ProfileMenu from "../Profile/ProfileMenu"

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
    const ResponsiveBurgerMenu = styled('div')(({theme}) => ({
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
                            <BurgerMenuButton/>
                        </ResponsiveBtn>
                    </Stack>
                </Toolbar>
                <ResponsiveBurgerMenu>
                    <BurgerMenu/>
                </ResponsiveBurgerMenu>
            </BurgerMenuProvider>
        </AppBar>
    )
}

export default Header