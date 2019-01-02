<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
%>

    /**
     * Delete method
     *
     * @param string|null $id <%= $singularHumanName %> id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $<%= $singularName %> = $this-><%= $currentModelName %>->get($id);

        if ($this->request->is(['post', 'put', 'delete'])) {
            if ($this-><%= $currentModelName; %>->delete($<%= $singularName %>)) {
                $this->Flash->success(__('{0} deletado(a).', '<%= $singularHumanName %>'));
            } else {
                $this->Flash->error(__('{0} não pode ser deletado(a).', '<%= $singularHumanName %>'));
            }
            return $this->redirect(['action' => 'index']);
        }else{
            $this->set(compact('<%= $singularName %>'));
            $this->set('_serialize', ['<%= $singularName %>']);
        }
        
    }
