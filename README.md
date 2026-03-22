🚌 IndiaBus — Bus Booking System
____
A single-page bus ticket booking application simulating a real-world reservation flow — route search, seat selection, payment processing, and cancellation — built entirely with vanilla JavaScript.
____
🛠️ Tech Stack

Frontend: HTML5, CSS3, Vanilla JavaScript (ES6+), Tailwind CSS
Storage: localStorage (client-side) with PHP backend fallback
Other: Browser Blob API (ticket download), CSS keyframe animations
____
✨ Features
```
🔐 Authentication — Login/Register with localStorage fallback; session persistence
🔍 Route Search — Filter by source, destination, bus type, and date via an interactive calendar
🚍 Dynamic Results — Generates realistic bus listings with operator name, timing, price, rating, and seat count
💺 Seat Selection — Interactive 40-seat grid with multi-select support
💳 Payment Flow — Card, UPI, and wallet options with field validation and animated success state
🎫 Ticket Download — Generates a .txt ticket via the Blob API
❌ Booking Cancellation — Cancel by Bus Number, Service ID, and Ticket Number
```

____
🚀 How to Run

bashgit clone https://github.com/Suraj190805/knowledge-decay-tracker.git
cd knowledge-decay-tracker
open index.html
Open Live in Browser
____
```
📁 Project Structure
├── index.html    # Complete SPA — markup, styles, and logic in one file
└── README.md
```
