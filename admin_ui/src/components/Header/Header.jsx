import classes from './Header.module.css'
import {AppBar, IconButton, Toolbar, Typography} from "@mui/material";
import MenuIcon from "@mui/icons-material/Menu"

function Header() {
    return (
        <header>
            <AppBar
                position="sticky"
            >
                <Toolbar>
                    <Typography
                        variant="h5"
                        sx={{flexGrow: '1'}}
                    >
                        FCT
                    </Typography>
                    <IconButton
                        size="medium"
                    >
                        <MenuIcon
                            fontSize="large"
                            color="text"
                        />
                    </IconButton>
                </Toolbar>
            </AppBar>
        </header>
    )
}

export default Header