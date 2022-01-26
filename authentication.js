const Database = require("./database");
const LocalStrategy = require('passport-local');
const passport = require("passport");

passport.use('local', 
    new LocalStrategy((username, password, cb) => {
        Database.query("SELECT * FROM Admin WHERE email = ? AND password_hash = ?", [username, password], (err, user) => {
            if(err) return cb(err);
            if(!user) return cb(null, false, {message: "Incorrect username or password"});
            return cb(null, user);
        });
    })
);

module.exports = passport;