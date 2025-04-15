<?php
$conn = mysqli_connect("localhost", "root", "", "xss_blog");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Insert comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    $sql = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
    mysqli_query($conn, $sql);
}

// Fetch comments
$result = mysqli_query($conn, "SELECT * FROM comments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>🌿 Stylish Blog (XSS Test)</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 850px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin: 20px 0;
        }
        input, textarea {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        button {
            background: #4CAF50;
            color: #fff;
            border: none;
            padding: 14px 22px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        .comment {
            background: #f9f9f9;
            border-left: 4px solid #4CAF50;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
        }
        .comment strong {
            color: #333;
        }
        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📝 Stylish Blog Page (XSS Playground)</h1>

    <form method="post">
        <input type="text" name="username" placeholder="Your Name" required>
        <textarea name="comment" placeholder="Write your comment here..." required></textarea>
        <button type="submit">Post Comment</button>
    </form>

    <h2>Comments:</h2>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='comment'><strong>{$row['username']}</strong>: {$row['comment']}</div>";
    }
    ?>
</div>

<footer>
    &copy; 2025 XSS Learning Blog | Made with ❤️
</footer>

</body>
</html>
