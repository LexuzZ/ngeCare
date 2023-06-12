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
  // Fungsi untuk merender file register yang ada pada folder 'src/views/register.ejs'
  form(req, res) {
    res.render("form", {
      // Definisikan semua varibel yang ingin ikut dirender kedalam register.ejs
      url: "http://localhost:5050/",
    });
  },
  // Fungsi untuk menyimpan data
  saveRegister(req, res) {
    // Tampung inputan user kedalam varibel username, email dan password
    let nama = req.body.nama;
    let keluhan = req.body.keluhan;

    // Pastikan semua varibel terisi
    if (nama && keluhan) {
      // Panggil koneksi dan eksekusi query
      pool.getConnection(function (err, connection) {
        if (err) throw err;
        connection.query(
          `INSERT INTO user (nama, keluhan) VALUES (?,?);`,
          [nama, keluhan],
          function (error, results) {
            if (error) throw error;
            // Jika tidak ada error, set library flash untuk menampilkan pesan sukses
            req.flash("color", "success");
            req.flash("status", "Yes..");
            req.flash("message", "Registrasi berhasil");
            // Kembali kehalaman login
            res.redirect("/login");
          }
        );
        // Koneksi selesai
        connection.release();
      });
    } else {
      // Kondisi apabila variabel username, email dan password tidak terisi
      res.redirect("/login");
      res.end();
    }
  },
};
