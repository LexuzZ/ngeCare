// Definisikan configurasi Database
const config = require("../configs/db");
// Gunakan library mysql
let mysql = require("mysql");
// Buat koneksi
let pool = mysql.createPool(config);

// Kirim error jika koneksi gagal
pool.on("error", (err) => {
  console.error(err);
});

module.exports = {
  form(req, res) {
    let id = req.session.userid;
    pool.getConnection(function (err, connection) {
      if (err) throw err;
      connection.query(
        `
                    SELECT * FROM user where id = '${id}';
                    `,
        function (error, results) {
          if (error) throw error;
          res.render("form", {
            url: "http://localhost:5050/",
          });
        }
      );
      connection.release();
    });
  },
};
