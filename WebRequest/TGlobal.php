<?php
/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace WebRequest;

/**
 * Trait global para registro e obter o objeto globalmente.
 */
trait TGlobal
{
    /**
     * Objeto global para a classe instânciada.
     *
     * @var object
     */
    protected static $class = null;

    /**
     * Obtém a instância global da classe a qual foi invocada.
     *
     * @throws \Exception Caso não tenha sido definido a instância global.
     *
     * @return object
     */
    public static function getInstance()
    {
        if(is_null(self::$class) === true)
        {
            $called_class = get_called_class();
            self::$class = new $called_class();
        }

        return self::$class;
    }
}
