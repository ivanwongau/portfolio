<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PropertyMultiOwnerships Controller
 *
 * @property \App\Model\Table\PropertyMultiOwnershipsTable $PropertyMultiOwnerships
 *
 * @method \App\Model\Entity\PropertyMultiOwnership[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PropertyMultiOwnershipsController extends AppController
{
    public function isAuthorized($user)
    {
        if (in_array($this->request->getParam('action'), ['add', 'edit'])) {
            return true;
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->getParam('action'), ['index'])) {
            $user = $this->Auth->user();
            if ($user['role'] === 'admin') {
                return true;
            }
        }
        return parent::isAuthorized($user); // TODO: Change the autogenerated stub
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('item_edit');

        $this->paginate = [
            'contain' => ['Properties'],
        ];
        $propertyMultiOwnerships = $this->paginate($this->PropertyMultiOwnerships);

        $this->set(compact('propertyMultiOwnerships'));

        $this->set('property_name', '');
        $this->set('access_level', '');
    }

    /**
     * View method
     *
     * @param string|null $id Property Multi Ownership id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('item_edit');

        $propertyMultiOwnership = $this->PropertyMultiOwnerships->get($id, [
            'contain' => ['Properties'],
        ]);

        $this->set('propertyMultiOwnership', $propertyMultiOwnership);

        $this->set('property_name', '');
        $this->set('access_level', '');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($property_id)
    {
        $this->viewBuilder()->setLayout('property_add');

        $propertyMultiOwnership = $this->PropertyMultiOwnerships->newEntity();
        if ($this->request->is('post')) {
            $propertyMultiOwnership = $this->PropertyMultiOwnerships->patchEntity($propertyMultiOwnership, $this->request->getData());
            $propertyMultiOwnership -> property_id = $property_id;
            if ($this->PropertyMultiOwnerships->save($propertyMultiOwnership)) {
                $this->Flash->success(__('The property multi ownership has been saved.'));
                $this->loadModel('LotOwners');
                // add lot according to the Num_of_lots when the multiOwnership record create
                for ($i=1; $i<$propertyMultiOwnership->Num_of_lot +1; $i++){
                    $lotOwners = $this->LotOwners ->newEntity();
                    $lotOwners->no_liabilities = "";
                    $lotOwners->lots_no = "lot $i";
                    $lotOwners->ownership_id = $propertyMultiOwnership->id;
                    $this->LotOwners->save($lotOwners);


                }

                return $this->redirect(['controller'=>'Properties','action' => 'dashboard',$property_id]);

            }
            $this->Flash->error(__('The property multi ownership could not be saved. Please, try again.'));
        }
        $properties = $this->PropertyMultiOwnerships->Properties->find('list', ['limit' => 200]);
        $this->set(compact('propertyMultiOwnership', 'properties'));
        $this->set('property_id',$property_id);
        $this->loadModel('Properties');
		$property = $this->Properties->find()
			->where([
                'id' => $property_id,
            ]);
		$this->set('property',$property);


    }

    /**
     * Edit method
     *
     * @param string|null $id Property Multi Ownership id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $property_id)
    {
        $this->viewBuilder()->setLayout('property_add');

        $this->set('property_id', $property_id);

        $propertyMultiOwnership = $this->PropertyMultiOwnerships->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $propertyMultiOwnership = $this->PropertyMultiOwnerships->patchEntity($propertyMultiOwnership, $this->request->getData());
            if ($this->PropertyMultiOwnerships->save($propertyMultiOwnership)) {
                $this->Flash->success(__('The property multi ownership has been saved.'));

                return $this->redirect(['controller' => 'Properties', 'action' => 'dashboard', $property_id]);
            }
            $this->Flash->error(__('The property multi ownership could not be saved. Please, try again.'));
        }
        $properties = $this->PropertyMultiOwnerships->Properties->find('list', ['limit' => 200]);
        $this->set(compact('propertyMultiOwnership', 'properties'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Property Multi Ownership id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $propertyMultiOwnership = $this->PropertyMultiOwnerships->get($id);
        if ($this->PropertyMultiOwnerships->delete($propertyMultiOwnership)) {
            $this->Flash->success(__('The property multi ownership has been deleted.'));
        } else {
            $this->Flash->error(__('The property multi ownership could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
