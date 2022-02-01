const passport = require("passport");
const Database = require("./Database");
const LocalStrategy = require('passport-local');

passport.use('local', 
    new LocalStrategy(async (username, password, next) => {
        try {
            // Try finding by email
            let user = await Database.user.findUnique({
                where: {email: username}
            })
            // If not found or password mismatch
            if(user == undefined || user.hash_password != password) 
                return next(null, false, {message: "Incorrect email or password"});
            // Else
            return next(null, user);
        } catch (e) {
            next(e);
        }
    })
)

passport.serializeUser((user, next) => {
    process.nextTick(()=>{
        next(null, user.user_id);
    })
})

passport.deserializeUser((user_id, next) => {
    process.nextTick(async ()=>{
        const user = await Database.user.findUnique({
            where: {user_id}
        });
        return next(null, user);
    })
})

module.exports = passport;