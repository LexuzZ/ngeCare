// Definisi Library yang digunakan
const express = require("express");
const session = require("express-session");
const bodyParser = require("body-parser");
const path = require("path");
const mysql = require("mysql");
const flash = require("req-flash");
const app = express();

// Definisi lokasi file router
const loginRoutes = require("./src/routes/router-login");
const registerRoutes = require("./src/routes/router-register");
const appRoutes = require("./src/routes/router-app");

// Configurasi dan gunakan library
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

// Configurasi library session
app.use(
  session({
    resave: false,
    saveUninitialized: false,
    secret: "t@1k0ch3ng",
    name: "secretName",
    cookie: {
      sameSite: true,
      maxAge: 6000000,
    },
  })
);
app.use(flash());
// tambahkan ini
app.use(function (req, res, next) {
  res.setHeader(
    "Cache-Control",
    "no-cache, private, no-store, must-revalidate, max-stale=0, post-check=0, pre-check=0"
  );
  res.setHeader("Pragma", "no-cache");
  next();
});
// end

app.use(express.static(__dirname + "/src"));

// Setting folder views
app.set("views", path.join(__dirname, "src/views"));
app.set("view engine", "ejs");

// Gunakan routes yang telah didefinisikan
app.use("/login", loginRoutes);
app.use("/register", registerRoutes);
app.use("/", appRoutes);

// db
const db = mysql.createConnection({
  host: "localhost",
  database: "dbcare",
  user: "root",
  password: "",
});
// data pasien
db.connect((err) => {
  if (err) throw err;
  console.log("database connected...");

  app.get("/form", (req, res) => {
    const sql = "SELECT * FROM user";
    db.query(sql, (err, result) => {
      const users = JSON.parse(JSON.stringify(result));
      res.render("form", { users: users, title: "Daftar Pasien dan Keluhan" });
    });
  });
  app.post("/tambah", (req, res) => {
    const insertSql = `INSERT INTO user (nama, keluhan) VALUES ('${req.body.nama}', '${req.body.keluhan}');`;

    db.query(insertSql, (err, result) => {
      if (err) throw err;
      res.redirect("/");
    });
  });
  // Menampilkan halaman edit
  app.get("/edit/:id", (req, res) => {
    const id = req.params.id;
    db.query("SELECT * FROM user WHERE id = ?", id, (err, result) => {
      if (err) throw err;
      res.render("edit", { data: result[0] });
    });
  });

  // Mengupdate data
  app.post("/edit/:id", (req, res) => {
    const id = req.params.id;
    const { nama, keluhan } = req.body;
    db.query(
      "UPDATE user SET nama = ?, keluhan = ? WHERE id = ?",
      [nama, keluhan, id],
      (err, result) => {
        if (err) throw err;
        res.redirect("/");
      }
    );
  });

  // Menghapus data
  app.get("/delete/:id", (req, res) => {
    const id = req.params.id;
    db.query("DELETE FROM user WHERE id = ?", id, (err, result) => {
      if (err) throw err;
      res.redirect("/");
    });
  });
  app.get("/artikel", (req, res) => {
    const sql = "SELECT * FROM volunter";
    db.query(sql, (err, result) => {
      const users = JSON.parse(JSON.stringify(result));
      res.render("artikel", { users: users, title: "Daftar Artikel" });
    });
  });
  app.post("/tambahArtikel", (req, res) => {
    const insertSql = `INSERT INTO volunter (penyakit, artikel) VALUES ('${req.body.penyakit}', '${req.body.artikel}');`;

    db.query(insertSql, (err, result) => {
      if (err) throw err;
      res.redirect("/");
    });
  });
  // Menampilkan halaman edit
  app.get("/editArtikel/:id", (req, res) => {
    const id = req.params.id;
    db.query("SELECT * FROM volunter WHERE id = ?", id, (err, result) => {
      if (err) throw err;
      res.render("editArtikel", { data: result[0] });
    });
  });

  // Mengupdate data
  app.post("/editArtikel/:id", (req, res) => {
    const id = req.params.id;
    const { penyakit, artikel } = req.body;
    db.query(
      "UPDATE volunter SET penyakit = ?, artikel = ? WHERE id = ?",
      [penyakit, artikel, id],
      (err, result) => {
        if (err) throw err;
        res.redirect("/");
      }
    );
  });

  // Menghapus data
  app.get("/deleteArtikel/:id", (req, res) => {
    const id = req.params.id;
    db.query("DELETE FROM volunter WHERE id = ?", id, (err, result) => {
      if (err) throw err;
      res.redirect("/");
    });
  });
});

// Gunakan port server
app.listen(5050, () => {
  console.log("Server Berjalan di Port : " + 5050);
});
