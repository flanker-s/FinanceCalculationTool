import classes from './Footer.module.css'
import {Grid, Typography} from "@mui/material"
import {useTheme} from "@mui/material"

function Footer() {
    const theme = useTheme();
    return (
        <Grid
            container
            sx={{backgroundColor: theme.palette.primary.main}}
        >
            <Typography
                variant="h4"
                sx={{
                    color: theme.palette.negative.main,
                }}
            >
                Footer
            </Typography>
        </Grid>
    )
}

export default Footer