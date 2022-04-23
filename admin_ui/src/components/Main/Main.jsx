import classes from './Main.module.css'
import {Container, Typography} from "@mui/material"

function Main(){
    return(
        <main>
            <Container
                sx={{
                    height: '100%',
                }}
            >
                <Typography
                    variant="h1"
                >
                    Main
                </Typography>
            </Container>
        </main>
    )
}

export default Main