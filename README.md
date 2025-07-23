# teenuplms

# Chay project tai folder teenuplms, su dung docker compose
docker-compose up -d

# Backend api url
http://localhost:8000

# Frontend url
http://localhost:80

# File sql data ./teenuplms.sql

# Lenh script demo api
# Them bo me hoc sinh
curl -X POST http://localhost:8000/api/parents \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Nguyễn Thị Hoa",
    "phone": "0976007898",
    "email": "hoapt@gmail.com"
  }'

# Them hoc sinh
curl -X POST http://localhost:8000/api/students \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Nguyễn Thị Nguyệt",
    "dob": "10/9/2010",
    "gender": 0,
    "current_grade": "K1",
    "parent_id": 1
  }'
# Them lop
curl -X POST http://localhost:8000/api/classes \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Lớp tô màu 1",
    "subject": "Tô màu",
    "day_of_week": 2,
    "teacher_name": "Ngô Thị Ngân",
    "max_students": 11
  }'
# Danh sach lop theo ngay
curl -X GET "http://localhost:8000/api/classes?day=3"
# Tao goi hoc
# Them lop
curl -X POST http://localhost:8000/api/subscriptions \
  -H "Content-Type: application/json" \
  -d '{
    "student_id": 1,
    "package_name": "Gói học thanh nhạc 10 buổi",
    "start_date": "08/1/2025",
    "end_date": "08/10/2025",
    "total_sessions": 11,
    "used_sessions": 11
  }'


