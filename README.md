```markdown
## Application For Employment

## Installation

### Backend

1. Clone the repository:

   ```bash
   git clone https://github.com/your-username/Application-For-Employment.git
   ```

2. Navigate to the backend directory:

   ```bash
   cd Application-For-Employment
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```
   
4. Install Node.js dependencies using npm:

   ```bash
   npm install
   ```

5. Run database migrations:

   ```bash
   php artisan migrate:fresh
   ```

6. Start the Laravel development server:

   ```bash
   php artisan serve
   ```

### Frontend (Vue.js)

1. Navigate to the Vue.js directory:

   ```bash
   cd vue
   ```

2. Install Node.js dependencies using npm:

   ```bash
   npm install
   ```

3. Compile and run the frontend:

   ```bash
   npm run dev
   ```

## Configuration

### Backend

The base URL for the backend API is set to `http://127.0.0.1:8000` by default. If your backend is running on a different URL, update it in the `store.js` file:

```javascript
// File: vue/src/stores/store.js

const response = await axios.post('http://127.0.0.1:8000/api/submit-form', state.formData);
```

Change the URL to match your backend server:

```javascript
const response = await axios.post('http://your-backend-url/api/submit-form', state.formData);
```

## Contact

If you have any questions or need further assistance, feel free to contact me at lenfelix2808@gmail.com
