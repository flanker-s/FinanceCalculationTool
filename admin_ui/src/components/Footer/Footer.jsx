import classes from './Footer.module.css'
import {Grid, Typography} from "@mui/material"
import {useTheme} from "@mui/material"

function Footer(){
    const theme = useTheme();
    return(
        <footer>
            <Grid
                container
                sx={{backgroundColor: theme.palette.primary.main}}
            >
                <Typography
                    variant="h4"
                    sx={{
                        color: theme.palette.text.white,

                    }}
                >
                    Footer
                </Typography>
            </Grid>
        </footer>
    )
}

export default Footer