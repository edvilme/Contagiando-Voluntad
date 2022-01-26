const express = require('express');
const Database = require('./database');
const passport = require('./authentication');
const path = require('path');
const app = express();
const PORT = process.env.PORT || 8080;

app.get('/', 
    (req, res) => {
        res.send(`
            <h1>Contagiando Voluntad</h1>
            <i>En construcción. Sistema de manejo de donaciones</i>
        `)
    }
);

app.get('/admin/login',
    (req, res) => {
        res.sendFile(path.join(__dirname, '/static/login.html'))
    }
)

app.post('/admin/login', 
    passport.authenticate('local', {session: true}), 
    (req, res) => {
        res.send("Signed in!");
    }
)


app.get('/campaigns', 
    (req, res) => {
        res.send("AA");
    }
)

app.listen(PORT, ()=>{
    console.log(`App listening at port ${PORT}`);
});