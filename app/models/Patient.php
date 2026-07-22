<?php
/**
 * Patient Model
 */

class Patient {
    private $db;
    private $table = 'patients';

    public $id;
    public $user_id;
    public $nik;
    public $date_of_birth;
    public $gender;
    public $blood_type;
    public $emergency_contact;
    public $emergency_phone;
    public $medical_history;
    public $allergies;

    public function __construct() {
        $this->db = getDB();
    }

    /**
     * Get patient by user_id
     */
    public function getByUserId($user_id) {
        $query = "SELECT p.*, u.full_name, u.email, u.phone, u.address 
                  FROM " . $this->table . " p
                  JOIN users u ON p.user_id = u.id
                  WHERE p.user_id = :user_id LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get patient by ID
     */
    public function getById($id) {
        $query = "SELECT p.*, u.full_name, u.email, u.phone, u.address, u.profile_photo
                  FROM " . $this->table . " p
                  JOIN users u ON p.user_id = u.id
                  WHERE p.id = :id LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create patient profile
     */
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, nik, date_of_birth, gender, blood_type, emergency_contact, emergency_phone, medical_history, allergies)
                  VALUES 
                  (:user_id, :nik, :date_of_birth, :gender, :blood_type, :emergency_contact, :emergency_phone, :medical_history, :allergies)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $data['user_id'], PDO::PARAM_INT);
        $stmt->bindParam(':nik', $data['nik'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':date_of_birth', $data['date_of_birth'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $data['gender'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':blood_type', $data['blood_type'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':emergency_contact', $data['emergency_contact'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':emergency_phone', $data['emergency_phone'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':medical_history', $data['medical_history'] ?? null, PDO::PARAM_STR);
        $stmt->bindParam(':allergies', $data['allergies'] ?? null, PDO::PARAM_STR);

        return $stmt->execute();
    }

    /**
     * Update patient profile
     */
    public function update($id, $data) {
        $allowed_fields = ['nik', 'date_of_birth', 'gender', 'blood_type', 'emergency_contact', 'emergency_phone', 'medical_history', 'allergies'];
        $fields = [];
        $params = [':id' => $id];

        foreach ($allowed_fields as $field) {
            if (isset($data[$field])) {
                $fields[] = "$field = :$field";
                $params[':' . $field] = $data[$field];
            }
        }

        if (empty($fields)) {
            return false;
        }

        $query = "UPDATE " . $this->table . " SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->db->prepare($query);

        return $stmt->execute($params);
    }

    /**
     * Get all patients (for admin/doctor)
     */
    public function getAll($limit = ITEMS_PER_PAGE, $offset = 0) {
        $query = "SELECT p.*, u.full_name, u.email, u.phone, u.address
                  FROM " . $this->table . " p
                  JOIN users u ON p.user_id = u.id
                  ORDER BY u.full_name ASC
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Count total patients
     */
    public function count() {
        $query = "SELECT COUNT(*) FROM " . $this->table;
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    /**
     * Search patients
     */
    public function search($search_term, $limit = ITEMS_PER_PAGE, $offset = 0) {
        $query = "SELECT p.*, u.full_name, u.email, u.phone
                  FROM " . $this->table . " p
                  JOIN users u ON p.user_id = u.id
                  WHERE u.full_name LIKE :search 
                  OR u.email LIKE :search 
                  OR p.nik LIKE :search
                  ORDER BY u.full_name ASC
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($query);
        $search = '%' . $search_term . '%';
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
