# User Management Web App
تطبيق ويب بسيط (HTML, CSS, JavaScript, PHP, MySQL) لإضافة مستخدمين، عرضهم في جدول، وتبديل حالة (Status) كل مستخدم بدون إعادة تحميل الصفحة.

## محتويات المشروع
| الملف | الوظيفة |
|---|---|
| `index.php` | الصفحة الرئيسية: الفورم + الجدول |
| `submit.php` | يستقبل بيانات الفورم ويحفظها في قاعدة البيانات |
| `toggle.php` | يستقبل طلب AJAX ويبدّل قيمة status (0/1) |
| `config.php` | إعدادات الاتصال بقاعدة البيانات |
| `database.sql` | كود إنشاء الجدول (يُستخدم في phpMyAdmin) |
| `style.css` | تنسيق الصفحة |
| `script.js` | كود الـ AJAX الخاص بزر Toggle |

---

## خطوة 1: رفع المشروع على GitHub

```bash
# داخل مجلد المشروع
git init
git add .
git commit -m "Initial commit - user management app"

# أنشئ Repository جديد فاضي من موقع GitHub (بدون README)
# ثم اربطه بالمشروع المحلي:
git remote add origin https://github.com/USERNAME/REPO-NAME.git
git branch -M main
git push -u origin main
```
> غيّر `USERNAME` و `REPO-NAME` باسم حسابك واسم الريبو اللي أنشأته.

---

## خطوة 2: إنشاء قاعدة البيانات على InfinityFree

1. سجّل دخول إلى **InfinityFree Control Panel**.
2. من قسم **MySQL Databases** أنشئ قاعدة بيانات جديدة، ودوّن:
   - اسم السيرفر (Hostname) — عادة يشبه `sqlXXX.infinityfree.com`
   - اسم المستخدم (Username) — يبدأ بـ `epiz_...`
   - كلمة المرور (Password)
   - اسم القاعدة (Database Name)
3. افتح **phpMyAdmin** من نفس اللوحة، اختر القاعدة التي أنشأتها، ثم اذهب لتبويب **SQL** والصق محتوى ملف `database.sql` واضغط **Go** لإنشاء الجدول والبيانات التجريبية.

---

## خطوة 3: تعديل بيانات الاتصال

افتح ملف `config.php` وعدّل القيم الأربعة بمعلومات قاعدة بياناتك:

```php
$db_host = "sqlXXX.infinityfree.com";
$db_user = "epiz_XXXXXXXX";
$db_pass = "your_password_here";
$db_name = "epiz_XXXXXXXX_dbname";
```

---

## خطوة 4: رفع الملفات على InfinityFree

1. من لوحة تحكم InfinityFree افتح **File Manager** (أو استخدم FTP بأي برنامج مثل FileZilla ببيانات FTP الموجودة في اللوحة).
2. ادخل مجلد `htdocs`.
3. ارفع كل الملفات (`index.php`, `submit.php`, `toggle.php`, `config.php`, `style.css`, `script.js`) داخل هذا المجلد مباشرة.
4. افتح الدومين المجاني اللي أعطاك إياه InfinityFree في المتصفح، مثال:
   `http://yoursite.epizy.com`

---

## خطوة 5: التجربة

1. عبّي حقل الاسم والعمر واضغط **Submit** → يتحفظ السجل في قاعدة البيانات ويظهر في الجدول.
2. اضغط زر **Toggle** أمام أي صف → تتغيّر قيمة Status بين 0 و1 **فوراً في الجدول** بدون إعادة تحميل الصفحة (بفضل طلب AJAX عن طريق `fetch()` في `script.js` الذي يتصل بـ `toggle.php`).

---

## شرح آلية عمل التحديث الفوري (Toggle)

- عند الضغط على زر Toggle، يرسل `script.js` طلب `POST` عبر `fetch()` إلى `toggle.php` ويمرر له `id` الصف.
- `toggle.php` يقرأ القيمة الحالية لـ `status` من قاعدة البيانات، يبدّلها (0 → 1 أو العكس)، يحدّثها في الجدول، ثم يرجّع النتيجة الجديدة بصيغة **JSON**.
- الـ JavaScript يستقبل الرد ويحدّث نص الخلية في الصفحة مباشرة (`textContent`)، فتظهر القيمة الجديدة أمام المستخدم بدون أي Refresh.

---

## ملاحظات أمنية
- الكود يستخدم **Prepared Statements** (`bind_param`) في جميع استعلامات الإدخال والتحديث لمنع SQL Injection.
- يُستحسن عدم رفع `config.php` ببيانات حقيقية إلى ريبو عام (Public)؛ يمكنك إضافة `config.php` إلى `.gitignore` ورفع نسخة `config.example.php` بدلاً منه إذا أردت حماية أكبر.
