const mysql = require('mysql');

const Database = mysql.createConnection({
    host: "contagiandovoluntad.org", 
    user: "contagi1_db_admin", 
    password: "m3p9V1hH7t.",
    database: "contagi1_mexicanos_ejemplares"
});

module.exports = Database;