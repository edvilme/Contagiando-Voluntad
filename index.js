const express = require('express');
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

app.listen(PORT, ()=>{
    console.log(`App listening at port ${PORT}`);
});