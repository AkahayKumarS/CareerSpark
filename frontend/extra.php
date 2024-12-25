<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Career Roadmap</title>

    <!-- Add your CSS styles here -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --background-color: #f4f6f7;
            --text-color: #2c3e50;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Arial", sans-serif;
        }

        body {
            background-color: var(--background-color);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .roadmap {
            max-width: 800px;
            width: 100%;
        }

        .roadmap-container {
            max-width: 800px;
            width: 100%;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .roadmap-header {
            background-color: var(--primary-color);
            color: white;
            text-align: center;
            padding: 20px;
        }

        .roadmap-header h1 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .course-timeline {
            position: relative;
            padding: 30px;
        }

        .course-item {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .course-item:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .course-item::before {
            content: "";
            position: absolute;
            left: -5px;
            top: 0;
            bottom: 0;
            width: 5px;
            background-color: var(--primary-color);
            transition: background-color 0.3s ease;
        }

        .course-item:hover::before {
            background-color: var(--secondary-color);
        }

        .course-icon {
            font-size: 3rem;
            margin-right: 20px;
            color: var(--primary-color);
        }

        .course-details {
            flex-grow: 1;
        }

        .course-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--text-color);
            margin-bottom: 10px;
        }

        .course-description {
            color: #7f8c8d;
            margin-bottom: 10px;
        }

        .course-dates {
            display: flex;
            justify-content: space-between;
            color: #95a5a6;
        }

        .career-destination {
            text-align: center;
            padding: 20px;
            background-color: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .arrow {
            font-size: 2rem;
            margin: 0 15px;
        }

        .download-btn {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }

        .download-btn button {
            padding: 10px 20px;
            font-size: 1rem;
            color: white;
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .download-btn button:hover {
            background-color: var(--secondary-color);
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                /* Ensures colors are preserved */
                print-color-adjust: exact;
            }

            body * {
                visibility: hidden;
                /* Hide everything by default */
            }

            .roadmap-container,
            .roadmap-container * {
                visibility: visible;
                /* Show only the roadmap container */
            }

            .roadmap-container {
                position: absolute;
                left: 50%;
                /* Move to the horizontal center */
                top: 50%;
                /* Move to the vertical center */
                transform: translate(-50%,
                        -50%);
                /* Perfectly center using transform */
                width: 90%;
                /* Ensure proper width */
                max-width: 800px;
                /* Maintain the original width */
            }

            .download-btn {
                display: none !important;
                /* Hide the download button */
            }
        }
    </style>
</head>

<body>
    <div class="roadmap">
        <div class="roadmap-container">
            <div class="roadmap-header">
                <h1>Career Roadmap</h1>
                <p>
                    Your personalized path to success as a
                    <strong>{{ job_role }}</strong>!
                </p>
            </div>

            <!-- Timeline Section -->
            <div class="course-timeline">
                {% for phase in roadmap %}
                <div class="course-item">
                    <!-- Dynamic Icon -->
                    <div class="course-icon" id="icon-{{ phase.skill }}">📚</div>
                    <div class="course-details">
                        <div class="course-title">{{ phase.skill }}</div>
                        <div class="course-description">Skill Development Path</div>
                        <div class="course-dates">
                            <span>Start: {{ phase.start_date }}</span>
                            <span>End: {{ phase.end_date }}</span>
                        </div>
                        {% if phase.courses %}
                        <ul class="mt-4">
                            {% for course in phase.courses %}
                            <li>
                                <a href="{{ course.course_link }}" target="_blank"
                                    class="text-primary hover:text-blue-700">
                                    <i class="fas fa-book mr-2"></i> {{ course.title }}
                                </a>
                                <span class="text-gray-500 ml-2">
                                    ({{ course.duration }} weeks)
                                </span>
                            </li>
                            {% endfor %}
                        </ul>
                        {% else %}
                        <p class="text-muted text-gray-400 italic">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            No courses available for this skill
                        </p>
                        {% endif %}
                    </div>
                </div>
                {% endfor %}
            </div>
        </div>

        <!-- Download Roadmap Button -->
        <div class="download-btn text-center mt-5">
            <button id="download-roadmap" class="btn btn-primary">
                <i class="fas fa-download mr-2"></i> Download Roadmap
            </button>
        </div>
    </div>

    <!-- Script -->
    <script>
        // Skill Icon Mapping
        const courseIcons = {
            // Database Related
            SQL: "🗄️", // or 'fa-database'
            "Database Management": "💾", // or 'fa-server'
            "PL/SQL": "📊", // or 'fa-code'
            MongoDB: "🍃", // or 'fa-leaf'

            // Hardware/Circuit Design
            "Hardware Design": "🔧", // or 'fa-microchip'
            "Circuit Design": "⚡", // or 'fa-bolt'
            "FPGA Programming": "🎛️", // or 'fa-microchip'
            VHDL: "📟", // or 'fa-memory'

            // General IT
            "Problem Solving": "🧩", // or 'fa-puzzle-piece'
            ITIL: "📚", // or 'fa-book'
            "Cloud Computing": "☁️", // or 'fa-cloud'

            // Cybersecurity
            "Ethical Hacking": "🔓", // or 'fa-user-secret'
            "Network Security": "🛡️", // or 'fa-shield-alt'
            "Penetration Testing": "🎯", // or 'fa-bullseye'
            SIEM: "🔍", // or 'fa-search'

            // Networking
            "Networking Protocols": "🌐", // or 'fa-network-wired'
            "Cisco Technologies": "📡", // or 'fa-broadcast-tower'
            SDN: "🔄", // or 'fa-project-diagram'
            "Cloud Networking": "☁️", // or 'fa-cloud-upload-alt'

            // Development
            Java: "☕", // or 'fa-java'
            Python: "🐍", // or 'fa-python'
            Git: "📦", // or 'fa-code-branch'
            Docker: "🐳", // or 'fa-docker'

            // API Development
            "API Development": "🔌", // or 'fa-plug'
            REST: "🔄", // or 'fa-exchange-alt'
            GraphQL: "📊", // or 'fa-project-diagram'
            OAuth2: "🔐", // or 'fa-key'

            // Project Management
            Leadership: "👥", // or 'fa-users'
            "Agile Methodologies": "🔄", // or 'fa-sync'
            "PMP Certification": "📜", // or 'fa-certificate'
            "MS Project": "📅", // or 'fa-calendar-alt'

            // Security Operations
            "Network Security": "🛡️", // or 'fa-shield-alt'
            Encryption: "🔒", // or 'fa-lock'
            "Incident Response": "🚨", // or 'fa-exclamation-triangle'
            "SOC Management": "👁️", // or 'fa-eye'

            // Technical Writing
            "Technical Writing": "📝", // or 'fa-pen'
            Research: "🔍", // or 'fa-search'
            Markdown: "📄", // or 'fa-file-alt'
            "API Documentation": "📑", // or 'fa-file-code'

            // AI/ML
            "Machine Learning": "🤖", // or 'fa-robot'
            TensorFlow: "🧮", // or 'fa-brain'
            NLP: "💭", // or 'fa-comments'
            "Computer Vision": "👁️", // or 'fa-eye'

            // Testing
            "Manual Testing": "🔍", // or 'fa-search'
            Selenium: "🤖", // or 'fa-robot'
            JIRA: "📋", // or 'fa-clipboard'
            Cypress: "🎯", // or 'fa-bullseye'

            // Business Analysis
            "Requirement Analysis": "📊", // or 'fa-chart-line'
            Communication: "💬", // or 'fa-comments'
            Tableau: "📈", // or 'fa-chart-bar'
            "SQL for Analysis": "📊", // or 'fa-database'

            // Customer Support
            "Customer Support": "🎧", // or 'fa-headset'
            "CRM Tools": "👥", // or 'fa-users'
            "Multichannel Communication": "📱", // or 'fa-comments'

            // Data Science
            "Data Analysis": "📊", // or 'fa-chart-bar'
            BigQuery: "🔍", // or 'fa-search'
            "Data Visualization": "📈", // or 'fa-chart-line'

            // IT Support
            Troubleshooting: "🔧", // or 'fa-wrench'
            "Active Directory": "🗄️", // or 'fa-folder-tree'
            "Ticketing Tools": "🎫", // or 'fa-ticket-alt'

            // Design
            Photoshop: "🎨", // or 'fa-paint-brush'
            Illustrator: "✒️", // or 'fa-pen-fancy'
            "After Effects": "🎬", // or 'fa-film'
            "3D Modeling": "💠", // or 'fa-cube'
        };

        // Assign Icons Dynamically
        document.querySelectorAll(".course-icon").forEach((icon) => {
            const skill = icon.id.replace("icon-", "");
            icon.textContent = courseIcons[skill] || "📚"; // Default icon if no match
        });

        // Download Roadmap as PDF
        document
            .getElementById("download-roadmap")
            .addEventListener("click", () => {
                window.print(); // Download roadmap
            });
    </script>
</body>

</html>