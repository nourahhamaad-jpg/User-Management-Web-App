# User Management Web App

A simple web app (HTML, CSS, JavaScript, PHP, MySQL) that lets you add users, view them in a table, and toggle each user's status without reloading the page.

## 🔗 Live Demo

**http://norah60.infinityfreeapp.com**

## Project Files

| File | Purpose |
|---|---|
| `index.php` | Main page: form + table |
| `submit.php` | Receives form data and saves it to the database |
| `toggle.php` | AJAX endpoint that flips the status value (0/1) |
| `config.php` | Database connection settings |
| `database.sql` | SQL script to create the table (run in phpMyAdmin) |
| `style.css` | Page styling |
| `script.js` | AJAX code for the Toggle button |

---

## Step 1: Push the project to GitHub

```bash
# inside the project folder
git init
git add .
git commit -m "Initial commit - user management app"

# create a new empty repository on GitHub (no README)
# then link it to the local project:
git remote add origin https://github.com/USERNAME/REPO-NAME.git
git branch -M main
git push -u origin main
```
> Replace `USERNAME` and `REPO-NAME` with your account and repo names.

---

## Step 2: Create the database on InfinityFree

1. Log in to the **InfinityFree Control Panel**.
2. Under **MySQL Databases**, create a new database and note down:
   - Hostname — usually looks like `sqlXXX.infinityfree.com`
   - Username — starts with `epiz_...`
   - Password
   - Database Name
3. Open **phpMyAdmin** from the same panel, select the database you created, go to the **SQL** tab, paste the contents of `database.sql`, and click **Go** to create the table and sample data.

---

## Step 3: Update the connection details

Open `config.php` and set the four values to match your database:

```php
$db_host = "sqlXXX.infinityfree.com";
$db_user = "epiz_XXXXXXXX";
$db_pass = "your_password_here";
$db_name = "epiz_XXXXXXXX_dbname";
```

---

## Step 4: Upload the files to InfinityFree

1. From the InfinityFree control panel, open **File Manager** (or use FTP with a client like FileZilla, using the FTP credentials from the panel).
2. Go into the `htdocs` folder.
3. Upload these files directly inside it: `index.php`, `submit.php`, `toggle.php`, `config.php`, `style.css`, `script.js`.
4. Open the free domain InfinityFree gave you in your browser, e.g.:
   `http://yoursite.epizy.com`

---

## Step 5: Try it out

1. Fill in the name and age fields and click **Submit** → the record is saved to the database and appears in the table.
2. Click **Toggle** next to any row → the status value switches between 0 and 1 **immediately in the table** without reloading the page (via an AJAX `fetch()` request in `script.js` to `toggle.php`).

---

## How the live update (Toggle) works

- When the Toggle button is clicked, `script.js` sends a `POST` request via `fetch()` to `toggle.php`, passing the row's `id`.
- `toggle.php` reads the current `status` value from the database, flips it (0 → 1 or vice versa), updates it in the table, and returns the new value as **JSON**.
- The JavaScript receives the response and updates the cell's text directly (`textContent`), so the new value appears instantly without any page refresh.

---

## Security notes
- The code uses **prepared statements** (`bind_param`) for all insert and update queries to prevent SQL injection.
- Avoid pushing `config.php` with real credentials to a public repository. Consider adding `config.php` to `.gitignore` and committing a `config.example.php` instead for extra safety.
