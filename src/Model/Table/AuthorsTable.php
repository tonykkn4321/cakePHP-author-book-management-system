<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Authors Model
 *
 * @property \App\Model\Table\BooksTable&\Cake\ORM\Association\HasMany $Books
 *
 * @method \App\Model\Entity\Author newEmptyEntity()
 * @method \App\Model\Entity\Author newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Author> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Author get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Author findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Author patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Author> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Author|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Author saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Author>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Author>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Author>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Author> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Author>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Author>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Author>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Author> deleteManyOrFail(iterable $entities, array $options = [])
 */
class AuthorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('authors');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('id');

        $this->hasMany('Books', [
            'foreignKey' => 'author_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 255)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 255)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        return $validator;
    }
}
