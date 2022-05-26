import {Routes, Route} from "react-router-dom"
import Header from "./components/Header/Header"
import Footer from "./components/Footer/Footer"
import Home from "./pages/Home/Home"
import {Container} from "@mui/material"
import React, {useContext} from "react"
import NavigationContext from "./contexts/NavigationContext"
import AuthContext from "./contexts/AuthContext"
import Login from "./pages/Login/Login"
import Loading from "./pages/Loading/Loading"
import Incomes from "./pages/ClientResources/Incomes"
import Expenses from "./pages/ClientResources/Expenses"

function App() {
    const {routes} = useContext(NavigationContext)
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
                                    <Route path={routes.Incomes} element={<Incomes/>}/>
                                    <Route path={routes.Expenses} element={<Expenses/>}/>
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