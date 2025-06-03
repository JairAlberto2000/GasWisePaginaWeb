const pool = require('../db');
const jwt = require('jsonwebtoken');

exports.login = async (req, res) => {
  const { email, password } = req.body;

  try {
    const [rows] = await pool.query('SELECT * FROM Administrador WHERE Email = ?', [email]);

    if (rows.length === 0) {
      return res.status(404).json({ message: 'Usuario no encontrado' });
    }

    const admin = rows[0];

    if (admin.Contraseña !== password) {
      return res.status(401).json({ message: 'Contraseña incorrecta' });
    }

    const token = jwt.sign(
      { adminId: admin.AdminID, email: admin.Email },
      process.env.JWT_SECRET,
      { expiresIn: '1h' }
    );

    res.json({ token, admin });
  } catch (err) {
    console.error('Error en login:', err);
    res.status(500).json({ message: 'Error del servidor' });
  }
};
