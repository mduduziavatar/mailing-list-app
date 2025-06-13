# 📧 Mailing List App

A simple Laravel mailing list application that allows users to manage contact lists, import contacts, and create campaigns. This project was built as part of a Laravel developer assessment.

---

## 🛠 Setup Instructions

### 1. Clone the Repository
```bash
git clone https://github.com/mduduziavatar/mailing-list-app.git
cd mailing-list-app
```
### 2. Install Dependencies
```bash
composer install
npm install && npm dev build
```
### 3. Create Environment File
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database
To use SQLite for quick setup:
```bash
touch database/database.sqlite
```

Update .env:
```bash
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
Or configure for MySQL if preferred. 

Fix: Create & Set Up Necessary Directories

Run the following commands from your project root:
```bash
mkdir -p storage/framework/{sessions,views,cache,data}
chmod -R 775 storage/framework
```
Clear Laravel’s Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```
### 5. Run Migrations and Seeders (Optional)
```bash
php artisan migrate
php artisan db:seed
```
### 6. Serve the App
```bash
php artisan serve
```
Visit: http://127.0.0.1:8000

📦 Features
    Create, edit, delete contact lists
	Add/remove contacts manually to/from lists
	Import contacts via CSV (using Laravel Excel)
	Create campaigns with subject, message (Trix editor), and linked list
	View campaign details with dynamic contact preview
	Download CSV template for importing
	All Contacts view with filters and pagination
	Dashboard showing total counts and recent entries
	Export campaigns as CSV
	Responsive UI styled with TailwindCSS

✅ Testing

Basic feature tests have been added for:
	Contact list creation
	CSV import of contacts
	Adding/removing contacts from lists
	Campaign creation

To run tests:
```bash
php artisan test
```
To test in isolation:
```bash
php artisan test --filter=ContactImportTest
```

Make sure to configure a separate SQLite database for testing in your .env.testing file:
```bash
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```
🧠 Assumptions
	Duplicate emails are handled gracefully by using firstOrCreate logic.
	Contacts must belong to at least one list to be shown.
	CSV files must have full_name and email headers.
	UI and UX kept minimal to focus on Laravel logic and flow.

📂 Notes
	No email sending functionality is implemented.
	All contact-campaign associations are based on list linkage at the time of viewing the campaign.
	Trix editor is used for rich text messages in campaigns.



