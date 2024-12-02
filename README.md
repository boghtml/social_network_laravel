
<h1>Laravel Social Network</h1>

<p>
    Welcome to the Laravel Social Network project! This application is a feature-rich social media platform built with Laravel, allowing users to connect, share content, and communicate in real-time.
</p>

<h2>Table of Contents</h2>
<ul>
    <li><a href="#features">Features</a></li>
    <li><a href="#technologies">Technologies Used</a></li>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#usage">Usage Instructions</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#database">DataBase Shema</a></li>
</ul>

<h2 id="features">Features</h2>
<ul>
    <li>User Registration and Authentication</li>
    <li>User Profiles with Editable Information</li>
    <li>Post Creation with Text and Images</li>
    <li>Follow/Unfollow Other Users</li>
    <li>Like, Comment, and Save Posts</li>
    <li>Real-time Chat between Users using Firebase Realtime Database</li>
    <li>Responsive Design using Bootstrap</li>
</ul>

<h2>Examples:</h2>

![image](https://github.com/user-attachments/assets/273c3267-8c77-41ed-b1d3-4a4780f1e818)
![image](https://github.com/user-attachments/assets/a1999fa1-fc11-49da-bc3e-2b97fa0ccc46)
![image](https://github.com/user-attachments/assets/8de568e4-e8a6-453f-9580-d96497126cbb)
![image](https://github.com/user-attachments/assets/6a3cfcdc-0323-4c0c-8e5b-ef6753594820)
![image](https://github.com/user-attachments/assets/02e6d261-d008-4017-be74-19b02a43c1a8)

<h2 id="technologies">Technologies Used</h2>
<ul>
    <li><strong>Back-end:</strong> Laravel PHP Framework</li>
    <li><strong>Front-end:</strong> Blade Templates, HTML5, CSS3, JavaScript, Alpine.js</li>
    <li><strong>Database:</strong> PostgreSQL</li>
    <li><strong>Real-time Communication:</strong> Firebase Realtime Database</li>
    <li><strong>Package Management:</strong> Composer, npm</li>
    <li><strong>Asset Compilation:</strong> Vite</li>
</ul>

<h2 id="installation">Installation</h2>
<p>Follow these steps to set up the project on your local machine:</p>

<h3>Prerequisites</h3>
<ul>
    <li>PHP >= 8.0</li>
    <li>Composer</li>
    <li>Node.js and npm</li>
    <li>PgAdmin4,  Database</li>
    <li>Git</li>
</ul>

<h3>Steps</h3>
<ol>
    <li><strong>Clone the repository:</strong>
        <pre><code>git clone https://github.com/yourusername/laravel-social-network.git</code></pre>
    </li>
    <li><strong>Navigate to the project directory:</strong>
        <pre><code>cd laravel-social-network</code></pre>
    </li>
    <li><strong>Install PHP dependencies:</strong>
        <pre><code>composer install</code></pre>
    </li>
    <li><strong>Install Node.js dependencies:</strong>
        <pre><code>npm install</code></pre>
    </li>
    <li><strong>Copy the example environment file and configure it:</strong>
        <pre><code>cp .env.example .env</code></pre>
        Update the <code>.env</code> file with your database credentials and other configurations.
    </li>
    <li><strong>Generate an application key:</strong>
        <pre><code>php artisan key:generate</code></pre>
    </li>
    <li><strong>Run database migrations and seeders:</strong>
        <pre><code>php artisan migrate --seed</code></pre>
    </li>
    <li><strong>Compile the assets:</strong>
        <pre><code>npm run dev</code></pre>
    </li>
    <li><strong>Start the development server:</strong>
        <pre><code>php artisan serve</code></pre>
    </li>
</ol>

<h3>Firebase Configuration</h3>
<p>To enable real-time chat functionality, you need to set up Firebase:</p>
<ol>
    <li>Create a project in <a href="https://console.firebase.google.com/">Firebase Console</a>.</li>
    <li>Enable Realtime Database in your Firebase project.</li>
    <li>Copy your Firebase configuration settings.</li>
    <li>Add your Firebase configuration to the <code>.env</code> file:
        <pre><code>
VITE_FIREBASE_API_KEY=your_api_key
VITE_FIREBASE_AUTH_DOMAIN=your_auth_domain
VITE_FIREBASE_DATABASE_URL=your_database_url
VITE_FIREBASE_PROJECT_ID=your_project_id
VITE_FIREBASE_STORAGE_BUCKET=your_storage_bucket
VITE_FIREBASE_MESSAGING_SENDER_ID=your_messaging_sender_id
VITE_FIREBASE_APP_ID=your_app_id
VITE_FIREBASE_MEASUREMENT_ID=your_measurement_id
        </code></pre>
    </li>
    <li>Update the Firebase configuration in <code>resources/js/firebase.js</code> to use the environment variables.</li>
    <li>Recompile your assets:
        <pre><code>npm run dev</code></pre>
    </li>
</ol>

<h2 id="usage">Usage Instructions</h2>
<p>After completing the installation steps, you can start using the application:</p>
<ol>
    <li>Access the application at <a href="http://localhost:8000">http://localhost:8000</a>.</li>
    <li><strong>Register a new account</strong> or <strong>log in</strong> if you already have one.</li>
    <li><strong>Edit your profile</strong> by adding a profile picture and bio.</li>
    <li><strong>Create posts</strong> by sharing text and images with your followers.</li>
    <li><strong>Follow other users</strong> to see their posts in your feed.</li>
    <li><strong>Like, comment, and save posts</strong> to interact with content.</li>
    <li><strong>Use the real-time chat</strong> to communicate with other users.</li>
</ol>

<h2 id="contributing">Contributing</h2>
<p>Contributions are welcome! If you'd like to contribute to this project, please follow these steps:</p>
<ol>
    <li>Fork the repository.</li>
    <li>Create a new branch for your feature or bug fix:
        <pre><code>git checkout -b feature/your-feature-name</code></pre>
    </li>
    <li>Commit your changes:
        <pre><code>git commit -m "Description of your changes"</code></pre>
    </li>
    <li>Push to your branch:
        <pre><code>git push origin feature/your-feature-name</code></pre>
    </li>
    <li>Create a pull request on GitHub.</li>
</ol>

<h2 id="database">DataBase Shema </h2>

![image](https://github.com/user-attachments/assets/a6ef5e6e-9dab-4433-8a2b-cd9e9e270e25)

<h2>Additional Information</h2>

<h3>Folder Structure</h3>
<p>The key directories in this project are:</p>
<ul>
    <li><code>app/</code>: Contains the core code of the application.</li>
    <li><code>resources/views/</code>: Contains Blade templates for the front-end.</li>
    <li><code>resources/js/</code>: Contains JavaScript files, including Firebase integration.</li>
    <li><code>public/</code>: Publicly accessible files, such as images and compiled assets.</li>
    <li><code>routes/</code>: Contains route definitions for the application.</li>
</ul>

<h3>Environment Variables</h3>
<p>Ensure that you have the following environment variables set in your <code>.env</code> file:</p>
<pre><code>
APP_NAME=Laravel
APP_ENV=local
APP_KEY=base64:generated_app_key
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=postgres
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Firebase Configuration
VITE_FIREBASE_API_KEY=your_api_key
VITE_FIREBASE_AUTH_DOMAIN=your_auth_domain
VITE_FIREBASE_DATABASE_URL=your_database_url
VITE_FIREBASE_PROJECT_ID=your_project_id
VITE_FIREBASE_STORAGE_BUCKET=your_storage_bucket
VITE_FIREBASE_MESSAGING_SENDER_ID=your_messaging_sender_id
VITE_FIREBASE_APP_ID=your_app_id
VITE_FIREBASE_MEASUREMENT_ID=your_measurement_id
</code></pre>

<h3>Firebase Rules</h3>
<p>Set up your Firebase Realtime Database rules to secure your data:</p>
<pre><code>
{
  "rules": {
    "messages": {
      "$chatId": {
        ".read": true,
        ".write": true
      }
    }
  }
}
</code></pre>
<p>Note: Adjust the rules as needed to enhance security.</p>

<h3>Troubleshooting</h3>
<ul>
    <li>If you encounter <strong>migration errors</strong>, ensure your database credentials are correct and the database exists.</li>
    <li>If <strong>assets are not loading</strong>, verify that <code>npm run dev</code> is running and Vite is compiling your assets.</li>
    <li>For <strong>authentication issues</strong>, ensure that sessions are properly configured and that you have run <code>php artisan key:generate</code>.</li>
</ul>

<h3>Credits</h3>
<p>This project was developed by [Your Name]. Special thanks to the Laravel community and all open-source contributors whose packages and resources made this project possible.</p>


</body>
</html>
