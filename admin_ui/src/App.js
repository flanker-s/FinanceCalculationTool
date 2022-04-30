import {Routes, Route} from "react-router-dom"
import Header from "./components/Header/Header"
import Footer from "./components/Footer/Footer"
import Home from "./pages/Home/Home"
import Defaults from "./pages/Defaults/Defaults"
import {Container} from "@mui/material"
import {useContext} from "react"
import GlobalRoutesContext from "./contexts/NavigationContext"
import AuthContext from "./contexts/AuthContext"
import Login from "./pages/Login/Login"
import Loading from "./pages/Loading/Loading"

function App() {
    const {routes} = useContext(GlobalRoutesContext)
    const {status, auth} = useContext(AuthContext)

    switch (status) {
        case 'checking': auth(); return (
            <Loading />
        )
        case 'authenticated': return (
                    <>
                        <Header/>
                        <main>
                            <Container sx={{height: '100%',}}>
                                <Routes>
                                    <Route exact path={routes.Home} element={<Home/>}/>>
                                    <Route path={routes.Defaults} element={<Defaults/>}/>
                                </Routes>
                            </Container>
                        </main>
                        <footer>
                            <Footer/>
                        </footer>
                    </>
        )
        case 'unauthenticated': return (
            <Login/>
        )
    }
}

export default App