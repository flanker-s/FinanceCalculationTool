import {BrowserRouter as Router, Routes, Route} from "react-router-dom"
import Header from "./components/Header/Header"
import Footer from "./components/Footer/Footer"
import Home from "./pages/Home/Home"
import Defaults from "./pages/Defaults/Defaults"
import {Container} from "@mui/material";
import {useContext, useState} from "react";
import GlobalRoutesContext from "./contexts/NavigationContext";

function App() {
    const {routes} = useContext(GlobalRoutesContext)

    return (
        <Router>
            <Header/>
            <main>
                <Container
                    sx={{
                        height: '100%',
                    }}
                >
                    <Routes>
                        <Route exact path={routes.Home} element={<Home/>}/>>
                        <Route path={routes.Defaults} element={<Defaults/>}/>
                    </Routes>
                </Container>
            </main>
            <footer>
                <Footer/>
            </footer>
        </Router>
    )
}

export default App