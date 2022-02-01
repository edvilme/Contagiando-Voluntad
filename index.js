const express = require("express");
const session = require("express-session");
const Database = require("./services/Database");
const eta = require('eta');
const passport = require('./services/AuthenticationService');

const app = express();

// Json
app.use(express.json())
app.use(express.urlencoded())

// Rendering
app.engine("eta", eta.renderFile);
app.set("view engine", "eta");
app.set("views", "./views");

// Session and auth
app.use(session({
    secret: "contagiando", 
    resave: false, 
    saveUninitialized: true
}));
app.use(passport.initialize());
app.use(passport.session());

// Iniciar sesión
app.post('/ingresar', 
    (req, res, next) => {
        passport.authenticate('local', async (err, user, info) => {
            try{
                if(err || !user) 
                    return res.redirect('/ingresar')
                req.logIn(user, {session: true}, (err) => {
                    if(err) return next(err);
                    return res.redirect('/perfil')
                })
            } catch(e){
                res.json(e);
            }
        })(req, res, next)
    }
)
app.get('/ingresar', 
    (req, res) => {
        res.render("authentication-login");
    }
)

// Registro
app.post('/registro', 
    async (req, res, next) => {
        let {name, last_name, email, telephone, location, birthday, profile_picture_url, hash_password} = req.body;
        birthday = new Date(birthday);
        try{
            const user = await Database.user.create({
                data: {name, last_name, email, telephone, location, birthday, profile_picture_url, hash_password}
            });
            req.logIn(user, {session: true});
            res.redirect('/perfil')
        } catch(e){
            console.log(e);
            res.json(e);
        }
    }
);
app.get('/registro', 
    (req, res) => {
        res.render("authentication-register");
    }
)

// Cerrar sesión
app.get('/salir', 
    (req, res) => {
        req.logOut();
        res.redirect('/ingresar');
    }
)

// /perfil
app.get('/perfil', 
    (req, res) => {
        if(req.isUnauthenticated())
            return res.redirect('/ingresar');
        res.render("profile", {user: req.user})
    }
)

// /Campaña
app.get('/' + encodeURIComponent('campaña'), 
    (req, res) => {
        res.send("Hola")
    }
);

app.post('/' + encodeURIComponent('camapaña'), 
    async (req, res) => {
        if(req.isUnauthenticated() || req.user.permissions != "admin")
            return res.json({error: "Unauthorized"}).status(400);
        const {name, description, year} = req.body;
        try{
            await Database.campaign.create({
                data: {
                    name, 
                    description, 
                    year, 
                    created_by_user_id: req.user.user_id
                }
            })
        } catch(e){

        }
    }
)


app.listen(8080, ()=>{
    console.log(`App listening at port ${8080}`)
})